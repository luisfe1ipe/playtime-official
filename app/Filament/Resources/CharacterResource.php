<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharacterResource\Pages;
use App\Models\Character;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CharacterResource extends Resource
{
    protected static ?string $model = Character::class;

    protected static ?string $modelLabel = 'Personagens';

    protected static ?string $navigationGroup = 'Jogos';
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';
    protected static ?string $activeNavigationIcon = 'heroicon-s-bolt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('game_id')
                    ->label('Jogo')
                    ->relationship(name: 'game', titleAttribute: 'name')
                    ->required()
                    ->preload()
                    ->searchable(),
                Forms\Components\FileUpload::make('image')
                    ->label('Imagem')
                    ->required()
                    ->image()
                    ->directory('characters/photos')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagem'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('game.name')
                    ->label('Jogo')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y')
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('game')
                    ->relationship('game', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCharacters::route('/'),
            'create' => Pages\CreateCharacter::route('/create'),
            'edit' => Pages\EditCharacter::route('/{record}/edit'),
        ];
    }
}
