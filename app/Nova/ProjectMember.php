<?php

namespace App\Nova;

use App\Models\ProjectMember as ProjectMemberModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProjectMember extends Resource
{
    /**
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * @var string
     */
    public static $group = 'Project Management';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ProjectMemberModel::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable()->showOnIndex(false),

            BelongsTo::make('Project'),

            BelongsTo::make('User'),
        ];
    }

    protected static function afterValidation(NovaRequest $request, $validator)
    {
        $user = $request->post('user');
        $unique = Rule::unique('project_members', 'project_id')->where(
            'user_id',
            $user
        );
        if ($request->route('resourceId')) {
            $unique->ignore($request->route('resourceId'));
        }

        $uniqueValidator = Validator::make($request->only('project'), [
            'project' => [$unique],
        ]);

        if ($uniqueValidator->fails()) {
            $validator
                ->errors()
                ->add('project', 'This project already has the chosen user.')
                ->add('user', 'This project already has the chosen user.');
        }
    }

    /**
     * Get the cards available for the request.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
