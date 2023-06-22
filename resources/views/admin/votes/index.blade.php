@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">Voti</h3>

    @if(count($votes) > 0)

    <?php

        $total = 0;
        $count = count($votes);     // Get the number of elements in the array

        foreach($votes as $vote)
        {
            $total += $vote['vote'];
        }

        $average = $total / $count;
        $roundedAverage = round($average, 1);

    ?>

    <div>
        Voto medio: {{ $roundedAverage }}
    </div>


    <table class="table">
        <thead>
          <tr>
            <th scope="col">Nome votante</th>
            <th scope="col">Voto</th>            
          </tr>
        </thead>
        <tbody>
            @foreach ($votes as $vote)
          <tr>
            <td> {{ $vote->voter }} </td>
            <td> {{ $vote->vote }} /5</td>
            
          </tr>
            @endforeach
        </tbody>
      </table>

    @else
    <div>non hai voti</div>
    @endif


</div>

@endsection