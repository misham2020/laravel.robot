@include('layouts.main')
<div class="pay"><a href="http://laravel.robo">Главная</a></div>
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
<div class="container">
    <div class="col-md-5">Дата: {{ $data }}</div>
<div class="row">
<table class="table">
    <thead>
      <tr>
        <th>Кто перевел</></th>
        <th>Кому перевел</th>
        <th>Статус платежа</th>
        <th>Списание средств</th>
        <th>Сумма</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($pays as $pay)
      <tr>
        <td>{{ $pay->madeUser->name }}</td>
        <td>{{ $pay->receiveUser->name }}</td>
        <td> {{ $pay->flags->name }}</td>
        <td>{{$pay->transfer_time}}</td>
        <td>{{$pay->amount}}</td>
      </tr>
      @endforeach
    </tbody>
</table>
</div>
</div>
