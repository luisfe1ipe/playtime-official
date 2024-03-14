<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RankResource\Pages;
use App\Filament\Resources\RankResource\RelationManagers;
use App\Models\Rank;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RankResource extends Resource
{
    protected static ?string $model = Rank::class;

    protected static ?string $navigationGroup = 'Jogos';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $activeNavigationIcon = 'heroicon-s-trophy';


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
                    ->directory('ranks/photos')
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
            'index' => Pages\ListRanks::route('/'),
            'create' => Pages\CreateRank::route('/create'),
            'edit' => Pages\EditRank::route('/{record}/edit'),
        ];
    }
}
