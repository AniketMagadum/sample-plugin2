<?php

namespace AniketMagadum\Helpdesk\Models;

use Backend\Facades\BackendAuth;
use Model;
use RainLab\User\Facades\Auth;

/**
 * Ticket Model
 */
class Ticket extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'aniketmagadum_helpdesk_tickets';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'title' => 'required',
        'category' => 'required'
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'comments' => Comment::class
    ];
    public $belongsTo = [
        'category' => Category::class
    ];
    public $belongsToMany = [
        'labels' => [Label::class, 'table' => 'aniketmagadum_helpdesk_label_ticket']
    ];
    public $morphTo = [
        'createable' => []
    ];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getStatusOptions()
    {
        return [
            'open' => 'Open',
            'closed' => 'Closed',
        ];
    }

    public function beforeValidate()
    {
        //Give preference to backend user if both loggedin
        if (BackendAuth::check()) {
            $this->createable = BackendAuth::getUser();
        } else {
            $this->createable = Auth::getUser();
        }
    }
}
