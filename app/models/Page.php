<?php

class Page extends Eloquent {

    protected $guarded = ['id'];

    //protected $softDelete = true;

    /**
     * Checks if the page exists
     *
     * @see Page::get();
     * @param string|int $identifier
     * @return bool
     */
    public static function pageExists($identifier)
    {
        try {
            static::get($identifier);
        } catch ( \Illuminate\Database\Eloquent\ModelNotFoundException $e ) {
            return false;
        }

        return true;
    }

    /**
     * Attempts to find and return the page
     *
     * @param string|int $identifier Page ID (int) or Page slug (string)
     * @param string
     * @return Page
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public static function getPage($identifier, $visibility = 'all')
    {
        if(is_int($identifier)) {
            $page = static::find($identifier);
        } else {
            $page = static::where('slug', '=', $identifier);
        }

        echo $visibility;

        if($visibility !== 'all') {
            $page->where('visibility', '=', $visibility);
        }

        return $page->firstOrFail();
    }

}