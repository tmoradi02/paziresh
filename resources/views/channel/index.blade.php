@extends('layouts.app')
@section('content')

    <table class="table table-bordered">
        <tr Style="height: 1px;">
            <th style="width:30px; background-color:lightblue;  text-align:center;">ردیف</th>     <!--height: 1px; -->
            <th style="width:300px; background-color:lightblue;  text-align:center;">عنوان شبکه</th>     <!--height: 1px; -->
            <th style="width:300px; background-color:lightblue; ">action</th>     <!--height: 1px; -->
        </tr>
        @foreach($channels as $channel)
            <tr class="rowt" style="height: 1px; ">
                <td class="rowtt" style="height: 1px; text-align:center;"></td>
                <td style="height: 1px;">{{$channel->channel_name}} </td>
                <td class="btn-group" style="height: 1px;">
                    @can('Edit_Channel')
                        <a href="{{route('channel.edit', $channel->id)}}" class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Channel')
                        <form action="{{route('channel.destroy' , $channel->id)}}" method="post">
                            
                            <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                            @csrf
                            @method('delete')
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

@endsection

