<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
    ];

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllItems()
    {
        return self::all();
    }

    /**
     *
     *
     * @param int $id
     * @return Menu|null
     */
    public static function getItemById(int $id)
    {
        return self::find($id);
    }

    /**
     *
     * @param array $data
     * @return Menu
     */
    public static function createItem(array $data)
    {
        return self::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Menu|null
     */
    public static function updateItem(int $id, array $data)
    {
        $menuItem = self::find($id);
        if ($menuItem) {
            $menuItem->update($data);
            return $menuItem;
        }

        return null;
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public static function deleteItem(int $id)
    {
        $menuItem = self::find($id);
        if ($menuItem) {
            return $menuItem->delete();
        }

        return null;
    }
}
