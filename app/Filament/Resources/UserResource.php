<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Manajemen User';

    /**
     * KONFIGURASI FORM (UNTUK EDIT & TAMBAH)
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Profil')
                    ->description('Data utama akun pengguna.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('username')
                            ->label('Username')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        DatePicker::make('dob')
                            ->label('Tanggal Lahir')
                            ->required()
                            ->maxDate(now()->subYears(15))
                            ->displayFormat('d/m/Y'),

                        // Tambahkan input Select Role di Form agar Admin bisa mengubah role user lain
                        Select::make('role')
                            ->label('Role Akses')
                            ->options([
                                'admin' => 'Admin',
                                'customer' => 'Customer',
                            ])
                            ->required()
                            ->native(false),
                    ])->columns(2),

                Section::make('Media & Keamanan')
                    ->schema([
                        FileUpload::make('avatar')
                            ->label('Foto Profil')
                            ->image()
                            ->disk('public')
                            ->directory('uploads/avatars')
                            ->avatar()
                            ->imageEditor(),

                        TextInput::make('password')
                            ->label('Password Baru')
                            ->password()
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->placeholder('Kosongkan jika tidak ingin mengubah password'),
                    ])->columns(2),
            ]);
    }

    /**
     * KONFIGURASI TABEL (DAFTAR USER)
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular()
                    ->disk('public')
                    ->getStateUsing(function ($record) {
                        if (!$record->avatar) return null;

                        // 1. Jika sudah berupa URL lengkap (Google Auth), pakai langsung
                        if (filter_var($record->avatar, FILTER_VALIDATE_URL)) {
                            return $record->avatar;
                        }

                        // 2. Jika di database sudah ada path-nya, gunakan langsung
                        if (str_starts_with($record->avatar, 'uploads/avatars/')) {
                            return $record->avatar;
                        }

                        // 3. Jika hanya nama file, tambahkan path foldernya
                        return 'uploads/avatars/' . $record->avatar;
                    }),

                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),

                // BAGIAN BADGE ROLE
                TextColumn::make('role')
                    ->label('Role')
                    ->badge() // Mengaktifkan tampilan badge
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',    // Warna Merah untuk Admin
                        'customer' => 'gray',   // Warna Abu-abu untuk Customer
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)) // Kapital huruf depan
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('dob')
                    ->label('Umur')
                    ->formatStateUsing(fn ($state) => $state 
                        ? Carbon::parse($state)->age . ' Tahun' 
                        : 'Belum diisi')
                    ->color('danger')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tambahkan Filter Role agar Admin bisa memfilter daftar berdasarkan Role
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'customer' => 'Customer',
                    ])
                    ->label('Filter Role'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}