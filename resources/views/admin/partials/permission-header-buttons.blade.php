<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('permissions.index', 'All Permissions', [], ['class' => 'btn btn-primary btn-xs']) }}
    {{ link_to_route('permissions.create', 'Create Permission', [], ['class' => 'btn btn-success btn-xs']) }}
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            Roles<span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li>{{ link_to_route('permissions.index', 'All Permissions') }}</li>
            <li>{{ link_to_route('permissions.create', 'Create Permission') }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>