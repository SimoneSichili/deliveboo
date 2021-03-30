@extends('layouts.app')

@section('scripts')

<div id="stats">
    <div class="container">
        <h1 class="text-center mb-5">Le tue statistiche</h1>
        <div class="clearfix">
            <a class="btn float-left" href="{{ route('admin.dashboard') }}" style="background-color: #23CAD3; color: #fff;">Torna alla dashboard</a>
            <select 
            class="bg-dark text-light mb-5 float-right" 
            style="padding: 6px 10px; border-radius: 5px;"
            v-model="year" @change="filterByYear">
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
            </select>
        </div>
       <div class="row">
            <canvas id="myChart"></canvas>    
       </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script src="{{ asset('js/stats.js') }}"></script>
@endsection