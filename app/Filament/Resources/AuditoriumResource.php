<?php

namespace App\Filament\Resources;

use App\Models\Seat;
use Filament\Notifications\Notification;
use App\Filament\Resources\AuditoriumResource\Pages;
use App\Models\Auditorium;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AuditoriumResource extends Resource
{
    protected static ?string $model = Auditorium::class;

    protected static ?string $navigationIcon = 'heroicon-o-tv'; // Ikon TV/Layar
    
    protected static ?string $navigationLabel = 'Studio Bioskop';

    protected static ?int $navigationSort = 2; // Urutan ke-2 setelah Film

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Ruangan')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Studio')
                            ->placeholder('Contoh: Studio 1, IMAX, Gold Class')
                            ->required()
                            ->maxLength(255),
                            
                        // Kita sembunyikan total_seats dari input manual
                        // Nanti ini akan dihitung otomatis saat kita generate kursi
                        // Tapi untuk sekarang kita biarkan manual dulu
                         Forms\Components\TextInput::make('total_seats')
                            ->label('Kapasitas Kursi')
                            ->numeric()
                            ->default(0)
                            ->disabled() // Kita kunci dulu, nanti diisi otomatis
                            ->helperText('Jumlah kursi akan bertambah otomatis saat kursi dibuat.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Studio')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('total_seats')
                    ->label('Total Kursi')
                    ->badge()
                    ->color('info'),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                // --- FITUR GENERATOR KURSI OTOMATIS ---
                Tables\Actions\Action::make('generate_seats')
                    ->label('Generate Kursi')
                    ->icon('heroicon-o-squares-2x2')
                    ->color('success') // Warna Hijau
                    ->requiresConfirmation()
                    ->modalHeading('Buat Kursi Otomatis')
                    ->modalDescription('Peringatan: Ini akan menghapus kursi lama di studio ini dan membuat yang baru.')
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('rows')
                                    ->label('Jumlah Baris (A-Z)')
                                    ->numeric()
                                    ->default(5) // Default 5 baris (A-E)
                                    ->required()
                                    ->minValue(1)
                                    ->maxValue(26), // Maksimal sampai Z
                                    
                                Forms\Components\TextInput::make('cols')
                                    ->label('Kursi per Baris')
                                    ->numeric()
                                    ->default(10) // Default 10 kursi per baris
                                    ->required()
                                    ->minValue(1),
                            ]),
                    ])
                    ->action(function (Auditorium $record, array $data) {
                        // 1. Hapus kursi lama biar tidak duplikat
                        Seat::where('auditorium_id', $record->id)->delete();

                        // 2. Loop Baris (1=A, 2=B, dst)
                        $totalSeats = 0;
                        for ($r = 1; $r <= $data['rows']; $r++) {
                            $rowLetter = chr(64 + $r); // Rumus Ajaib: 65=A, 66=B
                            
                            // 3. Loop Kolom (1, 2, 3...)
                            for ($c = 1; $c <= $data['cols']; $c++) {
                                Seat::create([
                                    'auditorium_id' => $record->id,
                                    'row_letter' => $rowLetter,
                                    'seat_number' => $c,
                                    'type' => 'standard', // Default Standard
                                ]);
                                $totalSeats++;
                            }
                        }

                        // 4. Update Total Kursi di data Studio
                        $record->update(['total_seats' => $totalSeats]);

                        // 5. Kirim Notifikasi Sukses
                        Notification::make()
                            ->title('Berhasil!')
                            ->body("$totalSeats kursi berhasil dibuat untuk studio ini.")
                            ->success()
                            ->send();
                    }),
                    
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuditoria::route('/'),
            'create' => Pages\CreateAuditorium::route('/create'),
            'edit' => Pages\EditAuditorium::route('/{record}/edit'),
        ];
    }
}