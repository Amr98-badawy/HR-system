<div class="row row-xs wd-xl-80p">
    <div class="col-sm-6 col-md-3">
        <button data-toggle="dropdown" class="btn btn-dark-gradient btn-block">Actions <i
                class="icon ion-ios-arrow-down tx-11 mg-l-3"></i></button>
        <div class="dropdown-menu">
            @if($show)
                @can($showGate)
                    <a href="{{ route('dashboard.'.$crudRoutePart.'.show', $key) }}" class="dropdown-item text-primary"><i
                            class="fas fa-eye"></i> View</a>
                @endcan
            @endif
            @can($editGate)
                <a href="{{ route('dashboard.'.$crudRoutePart.'.edit', $key) }}" class="dropdown-item text-warning"><i
                        class="fas fa-edit"></i> Edit</a>
            @endcan
            @can($deleteGate)
                <a href="" onclick="event.preventDefault();document.getElementById('deleteForm-{{$key}}').submit()"
                   class="dropdown-item text-danger"><i class="fas fa-trash"></i> Delete</a>
            @endcan
        </div>
    </div>
</div>
@can($deleteGate)
    <form action="{{ route('dashboard.'.$crudRoutePart.'.destroy', $key) }}" method="post" id="deleteForm-{{$key}}"
          class="d-none">
        @method('DELETE')
        @csrf
    </form>
@endcan
