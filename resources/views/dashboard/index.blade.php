   @extends('layouts.master')

   @section('content')
       <!-- Sale & Revenue Start -->
       <div class="container-fluid pt-4 px-4">
           <div class="row g-3">
               <div class="col-sm-6 col-xl-4">
                   <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                       <i class="fa-solid fa-laptop fa-3x text-primary"></i>
                       <div class="ms-3">
                           <p class="mb-2">Total Produk</p>
                           <h6 class="mb-0">{{ $totalProduk }}</h6>
                       </div>
                   </div>
               </div>
               <div class="col-sm-6 col-xl-4">
                   <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                       <i class="fa-solid fa-money-bill fa-3x text-primary"></i>
                       <div class="ms-3">
                           <p class="mb-2">Total Penjualan</p>
                           <h6 class="mb-0">{{ rupiah($totalPenjualan) }}</h6>
                       </div>
                   </div>
               </div>
               <div class="col-sm-6 col-xl-4">
                   <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                       <i class="fa fa-chart-area fa-3x text-primary"></i>
                       <div class="ms-3">
                           <p class="mb-2">Penjualan Hari</p>
                           <h6 class="mb-0">{{ rupiah($penjualanHari) }}</h6>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- Sale & Revenue End -->


       <!-- Grafik Chart Start -->
       <div class="container-fluid pt-4 px-4">

           <div class="row g-4">
               <div class="col-md-2 col-xl-6">
                   <div class="bg-light text-center rounded p-2">
                       <div class="d-flex align-items-center justify-content-between mb-2">
                       </div>
                       <div class="col">
                           {!! $harianChart->container() !!}
                       </div>
                   </div>
               </div>
               <div class="col-md-1 col-xl-6">
                   <div class="bg-light text-center rounded p-2">
                       <div class="d-flex align-items-center justify-content-between mb-2">
                       </div>
                       <div class="col">
                           {!! $mingguChart->container() !!}

                       </div>
                   </div>
               </div>
               <div class="col-md-2 col-xl-6">
                   <div class="bg-light text-center rounded p-2">
                       <div class="d-flex align-items-center justify-content-between mb-2">
                       </div>
                       <div class="col">
                           {!! $bulanChart->container() !!}
                       </div>
                   </div>
               </div>
               <div class="col-md-1 col-xl-6">
                   <div class="bg-light text-center rounded p-2">
                       <div class="d-flex align-items-center justify-content-between mb-2">
                       </div>
                       <div class="col">
                           {!! $tahunChart->container() !!}
                       </div>
                   </div>
               </div>
           </div>
       </div>

       <script src="{{ $harianChart->cdn() }}"></script>
       {{ $harianChart->script() }}
       <script src="{{ $mingguChart->cdn() }}"></script>
       {{ $mingguChart->script() }}
       <script src="{{ $bulanChart->cdn() }}"></script>
       {{ $bulanChart->script() }}
       <script src="{{ $tahunChart->cdn() }}"></script>
       {{ $tahunChart->script() }}

       {{-- SweetAlert --}}
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       @if ($message = session('success'))
           <script>
               Swal.fire({
                   icon: "success",
                   title: "{{ $message }}",
                   showConfirmButton: true,
                   timer: 1500
               });
           </script>
       @endif
   @endsection
