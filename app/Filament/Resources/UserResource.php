<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Carbon\Carbon;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users'; // Ikon di sidebar

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                // Menampilkan Foto Profil
                ImageColumn::make('avatar')
                    ->circular()
                    ->disk('public')
                    ->prefix('uploads/avatars/'),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Lengkap'),

                TextColumn::make('email')
                    ->copyable(),

                // Menampilkan Tanggal Lahir & Umur
                TextColumn::make('dob')
                    ->label('Umur')
                    ->formatStateUsing(fn ($state) => $state 
                        ? Carbon::parse($state)->age . ' Tahun' 
                        : 'Belum diisi')
                    ->color('danger'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Terdaftar Pada'),
            ])
            ->filters([
                // Tambahkan filter jika perlu (misal: filter umur > 15)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}