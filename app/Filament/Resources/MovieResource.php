<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovieResource\Pages;
use App\Models\Movie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';
    
    protected static ?string $navigationLabel = 'Film Bioskop';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Film')
                            ->required()
                            ->maxLength(255),

                        // --- FITUR BARU: GENRE ---
                        Forms\Components\Select::make('genre')
                            ->label('Genre')
                            ->options([
                                'Action' => 'Action',
                                'Adventure' => 'Adventure',
                                'Comedy' => 'Comedy',
                                'Drama' => 'Drama',
                                'Horror' => 'Horror',
                                'Romance' => 'Romance',
                                'Sci-Fi' => 'Sci-Fi',
                                'Thriller' => 'Thriller',
                                'Animation' => 'Animation',
                            ])
                            ->searchable()
                            ->required(),

                        Forms\Components\Textarea::make('description')
                            ->label('Sinopsis')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(3) // Bagi jadi 3 kolom
                            ->schema([
                                Forms\Components\TextInput::make('duration_minutes')
                                    ->label('Durasi (Menit)')
                                    ->numeric()
                                    ->required(),

                                Forms\Components\DatePicker::make('release_date')
                                    ->label('Tanggal Tayang')
                                    ->required(),

                                // --- FITUR BARU: RATING FILM ---
                                Forms\Components\TextInput::make('rating')
                                    ->label('Rating (0-10)')
                                    ->numeric()
                                    ->step(0.1) // Bisa desimal (contoh 8.5)
                                    ->minValue(0)
                                    ->maxValue(10)
                                    ->placeholder('8.5'),
                            ]),
                    ]),

                Forms\Components\Section::make('Media & Status')
                    ->schema([
                       Forms\Components\TextInput::make('poster_url')
                        ->label('URL Poster Film')
                        ->url()
                        ->placeholder('https://image.tmdb.org/t/p/w500/xxx.jpg')
                        ->required(),

                        Forms\Components\TextInput::make('trailer_url')
                            ->label('Link Trailer (YouTube)'),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                // --- FITUR BARU: UMUR ---
                                Forms\Components\Select::make('age_rating')
                                    ->label('Kategori Umur')
                                    ->options([
                                        'SU' => 'SU (Semua Umur)',
                                        '13+' => '13+ (Remaja)',
                                        '17+' => '17+ (Dewasa)',
                                        '21+' => '21+ (Khusus Dewasa)',
                                    ])
                                    ->required(),

                                Forms\Components\Select::make('status')
                                    ->label('Status Tayang')
                                    ->options([
                                        'now_playing' => 'Sedang Tayang',
                                        'coming_soon' => 'Segera Tayang',
                                        'expired' => 'Selesai',
                                    ])
                                    ->default('now_playing')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('poster_url')
                    ->label('Poster')
                    ->disk(null) // Penting agar Filament membaca link eksternal
                    ->square(), // Kosongkan disk agar Filament mengambil langsung dari URL

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->weight('bold')
                    ->label('Judul')
                    ->description(fn (Movie $record): string => $record->genre ?? '-'), // Tampilkan Genre di bawah judul

                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->icon('heroicon-s-star')
                    ->iconColor('warning') // Warna kuning emas
                    ->sortable(),

                Tables\Columns\TextColumn::make('age_rating')
                    ->label('Umur')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'SU' => 'success',
                        '13+' => 'info',
                        '17+' => 'warning',
                        '21+' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'now_playing' => 'success',
                        'coming_soon' => 'warning',
                        'expired' => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('genre'),
                Tables\Filters\SelectFilter::make('age_rating'),
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
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }
}