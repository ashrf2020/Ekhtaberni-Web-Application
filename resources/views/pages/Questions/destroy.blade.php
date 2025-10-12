<div class="modal fade" id="delete_exam{{$question->id}}" tabindex="-1"
     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('questions.destroy','test')}}" method="post">
            {{method_field('delete')}}
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;"
                        class="modal-title" id="exampleModalLabel">{{ trans('questions.delete_title') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{{ trans('questions.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ trans('questions.delete_confirm') }}</p>
                    <input type="hidden" name="id" value="{{$question->id}}">
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('questions.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('questions.delete') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
