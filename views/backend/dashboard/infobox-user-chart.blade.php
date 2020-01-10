@component('backend.components.box_standard', ['icon' => 'users', 'title' => 'Benutzer', 'class' => 'col-md-6'])
    <div id="chart-users"></div>
    @areachart('userchart', 'chart-users')
@endcomponent
