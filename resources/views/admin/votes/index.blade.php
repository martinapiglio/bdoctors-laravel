@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="vote-title mb-4">Voti</h3>

    @if(count($votes) > 0)

    <?php

        $total = 0;
        $count = count($votes);  

        foreach($votes as $vote)
        {
            $total += $vote['vote'];
        }

        $average = $total / $count;
        $roundedAverage = round($average, 1);

    ?>

    <div class="blue">
        Voto medio: {{ $roundedAverage }}
    </div>


    <table class="table mb-3">
        <thead>
          <tr>
            <th scope="col">Nome votante</th>
            <th scope="col">Data del voto</th>
            <th scope="col">Voto</th>            
          </tr>
        </thead>
        <tbody>
            @foreach ($votes as $vote)
          <tr class="row-table">
            <td> {{ $vote->voter }} </td>
            <td> {{ date('d/m/Y H:i', strtotime($vote->created_at)) }} </td>
            <td> {{ $vote->vote }} / 5</td>
          </tr>
            @endforeach
        </tbody>
      </table>

    @else
    <div class="blue">non hai voti</div>
    @endif

    <div class="d-flex justify-content-center mt-4">
       <button class="btn btn-dark text-center"><a href="{{ route('admin.dashboard') }}">Torna alla Dashboard</a></button>
    </div>   

</div>

@endsection