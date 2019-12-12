@component('backend.components.box_standard', ['icon' => 'users', 'title' => 'Benutzer', 'class' => 'col-xs-12'])
    <div id="chart-users"></div>
    @areachart('userchart', 'chart-users')
@endcomponent
