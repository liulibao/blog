@extends('admin.layouts.app')

@section('contents')
<div class="row">
    <div class="col-xs-12" style="text-align: center">
         <pre class="page-404">
                      .----.
                   _.'__    `.
               .--($)($$)---/#\
             .' @          /###\
             :         ,   #####
              `-..__.-' _.-\###/
                    `;_:    `"'
                  .'"""""`.
                 /,  ya ,\\
                //  404!  \\
                `-._______.-'
                ___`. | .'___
               (______|______)

             @if( null !== session('error') ) {{ session('error') }} @endif
             <a href="javascript:history.back(-1)">返回</a>
          </pre>

    </div>
</div>
@stop