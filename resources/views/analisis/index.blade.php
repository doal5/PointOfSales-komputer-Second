@extends('layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Analisis</h6>
                    <div class="row p-2">
                        <div class="col-md-12">
                            <div class="bg-light rounded h-10 p-2">
                                <form class="row p-2">
                                    <div class="col">
                                        {!! $chart->container() !!}
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endsection
