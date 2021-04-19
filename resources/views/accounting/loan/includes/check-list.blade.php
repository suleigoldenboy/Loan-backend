<div class="tab-pane fade" id="check-list-details" role="tabpanel" aria-labelledby="check-list-details-tab">
    <div class="media">
        <div class="media-body">
        @if($getCheckLists)
             @foreach($getCheckLists as $val)
             <p class="row" style="text-align:center; margin-left:5px;">{{$val->title}}</p>
              @if($val->option_1)
                <div class="n-chk">
                    <label class="new-control new-radio @if($val->option_1 == 'No') radio-danger @else  radio-success @endif">
                        <input type="radio" class="new-control-input" name="answer_{{$val->id}}[$val->id}]" value="{{$val->option_1}}">
                        <span class="new-control-indicator"></span>&nbsp;&nbsp;
                       {{$val->option_1}}
                    </label>
                </div>
                @endif
                @if($val->option_2)
                <div class="n-chk">
                    <label class="new-control new-radio @if($val->option_2 == 'No') radio-danger @else  radio-success @endif">
                        <input type="radio" class="new-control-input" name="answer_{{$val->id}}[$val->id}]" value="{{$val->option_2}}">
                        <span class="new-control-indicator"></span>&nbsp;&nbsp;{{$val->option_2}}
                    </label>
                </div>
                @endif
                @if($val->option_3)
                <div class="n-chk">
                    <label class="new-control new-radio @if($val->option_3 == 'No') radio-danger @else  radio-success @endif">
                        <input type="radio" class="new-control-input" name="answer_{{$val->id}}[$val->id}]" value="{{$val->option_3}}">
                        <span class="new-control-indicator"></span>&nbsp;&nbsp;{{$val->option_3}}
                    </label>
                </div>
                @endif
                @if($val->option_4)
                <div class="n-chk">
                    <label class="new-control new-radio @if($val->option_4 == 'No') radio-danger @else  radio-success @endif">
                        <input type="radio" class="new-control-input" name="answer_{{$val->id}}[$val->id}]" value="{{$val->option_4}}">
                        <span class="new-control-indicator"></span>&nbsp;&nbsp;{{$val->option_4}}
                    </label>
                </div>
                @endif
                @if($val->option_5)
                <div class="n-chk">
                    <label class="new-control new-radio @if($val->option_5 == 'No') radio-danger @else  radio-success @endif">
                        <input type="radio" class="new-control-input" name="answer_{{$val->id}}[$val->id}]" value="{{$val->option_5}}">
                        <span class="new-control-indicator"></span>&nbsp;&nbsp;{{$val->option_5}}
                    </label>
                </div>
                @endif
             @endforeach
            @endif
        </div>
    </div>
</div>