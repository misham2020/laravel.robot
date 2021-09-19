@include('layouts.main')
<body>
    <div class="pay"><a href="http://laravel.robo/pay">Операции</a></div>
<div class="container">
    <h4>Перевод денег</h4>
<div class="row">
    @foreach(['success','danger'] as $status)
        @if(session()->has($status))
            <div class="alert alert-{{$status}} text-center">
                {{session()->get($status)}}
            </div>
        @endif
    @endforeach
    @if ($errors->any())
    <div class="alert alert-danger text-center">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{ Form::open(['action' => 'Users_paymentsController@store','method' => 'POST', 'class' => 'col-md-5']) }}
    {{ Form::token() }}
<div class="input-group">
<label for="From whom" class="col-5 col-form-label">От кого:</label>
<select name="made" class="form-control" id="made">
@foreach ($users as $user)
  <option value="{{$user->id}}">{{$user->name}}</option> <br>
@endforeach
</select>
</div>
<div class="input-group">
<label for="Whom" class="col-5 col-form-label">Кому:</label>
<select name="receive" class="form-control" id="receive">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option> <br>
                @endforeach
            </select>

</div>
<div class="form-group">
        <label for="text-input" class="col-2 col-form-label">Сумма:</label>
        <div class="col-10 ">
            <input class="form-control" type="number" value="{{ old('amount') }}" name="amount" id="text-input">
        </div>
</div>
<label for="time-input" class="col-5 col-form-label">Дата:</label>
     <div class="form-group">
        <div class='col-sm-10'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker'>
                    <input type='text' name="date" id="time-input" class="form-control"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div> 
    </div>
    <button class="btn btn-primary">Перевести</button>
    {{ Form::close() }}

</div>
</div>
<script type="text/javascript" src="{{ asset('inc/js/main.js') }}"></script>
<script type="text/javascript">
$(() => {
    $(() => {
        $('#datetimepicker').datetimepicker({
            locale: 'ru',
            format: 'YYYY-MM-DD HH:00:00'
        });
    });
});
</script>
</body>
</html>