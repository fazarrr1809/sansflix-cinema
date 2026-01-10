<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    
    protected static ?string $navigationLabel = 'Data Transaksi';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Kita buat Read Only saja karena Admin jarang edit data transaksi manual
                Forms\Components\TextInput::make('booking_code')
                    ->label('Kode Booking')
                    ->readOnly(),
                Forms\Components\TextInput::make('customer_name')
                    ->label('Nama Pemesan')
                    ->readOnly(),
                Forms\Components\TextInput::make('total_price')
                    ->prefix('Rp')
                    ->readOnly(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Lunas',
                        'cancelled' => 'Batal',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Booking')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('booking_code')
                    ->label('Kode')
                    ->weight('bold')
                    ->searchable()
                    ->copyable(), // Biar bisa dicopy admin

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('showtime.movie.title')
                    ->label('Film')
                    ->limit(20),

                Tables\Columns\TextColumn::make('total_tickets')
                    ->label('Jml Tiket')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->weight('bold')
                    ->color('success'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'paid' => 'success',
                        'cancelled' => 'danger',
                    }),
            ])
            ->defaultSort('created_at', 'desc') // Transaksi terbaru di atas
            ->filters([
                //
            ])
            ->actions([
                //
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}