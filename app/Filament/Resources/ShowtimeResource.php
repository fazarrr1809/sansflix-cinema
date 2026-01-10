<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShowtimeResource\Pages;
use App\Models\Showtime;
use App\Models\Movie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Carbon\Carbon; // Wajib import Carbon untuk hitung jam

class ShowtimeResource extends Resource
{
    protected static ?string $model = Showtime::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    
    protected static ?string $navigationLabel = 'Jadwal Tayang';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Atur Jadwal')
                    ->schema([
                        // 1. INPUT STUDIO
                        Forms\Components\Select::make('auditorium_id')
                            ->relationship('auditorium', 'name')
                            ->label('Studio')
                            ->required(),

                        // 2. INPUT FILM (Logic Baru)
                        Forms\Components\Select::make('movie_id')
                            ->relationship('movie', 'title')
                            ->label('Film')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->reactive() // Agar bereaksi saat dipilih
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                // Saat ganti film, cek apakah jam mulai sudah diisi?
                                // Kalau sudah, hitung ulang jam selesai berdasarkan durasi film baru
                                $startTime = $get('starts_at');
                                if ($state && $startTime) {
                                    $movie = Movie::find($state);
                                    if ($movie) {
                                        $end = Carbon::parse($startTime)->addMinutes($movie->duration_minutes);
                                        $set('ends_at', $end->toDateTimeString());
                                    }
                                }
                            }),

                        // 3. INPUT JAM MULAI (Logic Baru)
                        Forms\Components\DateTimePicker::make('starts_at')
                            ->label('Waktu Mulai')
                            ->required()
                            ->seconds(false)
                            ->reactive() // Agar bereaksi saat diisi
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                // Saat jam diisi, cek apakah film sudah dipilih?
                                // Kalau sudah, ambil durasi film itu dan hitung jam selesai
                                $movieId = $get('movie_id');
                                if ($state && $movieId) {
                                    $movie = Movie::find($movieId);
                                    if ($movie) {
                                        $end = Carbon::parse($state)->addMinutes($movie->duration_minutes);
                                        $set('ends_at', $end->toDateTimeString());
                                    }
                                }
                            }),

                        // 4. INPUT JAM SELESAI (Otomatis)
                        Forms\Components\DateTimePicker::make('ends_at')
                            ->label('Waktu Selesai')
                            ->required()
                            ->readOnly(), // User tidak bisa ubah manual

                        // 5. HARGA
                        Forms\Components\TextInput::make('ticket_price')
                            ->label('Harga Tiket (Rp)')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(50000)
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('movie.title')
                    ->label('Film')
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('auditorium.name')
                    ->label('Studio')
                    ->sortable(),

                Tables\Columns\TextColumn::make('starts_at')
                    ->label('Jam Tayang')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('ends_at')
                    ->label('Selesai')
                    ->dateTime('H:i')
                    ->color('gray'),

                Tables\Columns\TextColumn::make('ticket_price')
                    ->label('Harga')
                    ->money('IDR'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('auditorium')
                    ->relationship('auditorium', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListShowtimes::route('/'),
            'create' => Pages\CreateShowtime::route('/create'),
            'edit' => Pages\EditShowtime::route('/{record}/edit'),
        ];
    }
}