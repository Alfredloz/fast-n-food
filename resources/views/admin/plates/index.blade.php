@extends('layouts.dashboard')

@section('content')

<h2>Menu</h2>

<a class="btn btn-primary mt-5" href="{{ route('admin.plates.create') }}" role="button">Add a plate</a>

<div class="d-flex flex-wrap">
    @foreach ($plates as $plate)

    {{-- Card plate --}}
    <div class="card mr-3 mt-5" style="width: 16rem;">
        @if ($plate->picture)
            
        <img class="card-img-top" style="height: 10rem" src="{{ asset('storage/' . $plate->picture) }}" alt="">
        @else
            <img src="{{ asset('images/plate_ph.png') }}" alt="logo placeholder" class="card-img-top" style="height: 10rem">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{$plate->name}}</h5>

            {{-- Visibility form --}}
            <form id="{{$plate->id}}" action="{{route('admin.plates.visibility', ['plate' => $plate->slug]) }}"
                method="post">
                @csrf
                @method('PUT')
                {{-- Input radio visibility --}}
                <div class="form-check my-4">
                    <input type="radio" class="form-check-input" name="visibility" value="1" onclick="this.form.submit()"
                        {{ $plate->visibility ? 'checked' : '' }}>
                    <label for="visibility" class="form-check-label">Available</label>
                    <br>
                    <input type="radio" class="form-check-input" name="visibility" value="0" onclick="this.form.submit()"
                        {{ $plate->visibility ? '' : 'checked'  }}>
                    <label for="visibility" class="form-check-label">Not Available</label>
                </div>
            </form>

            <p class="card-text overflow-auto" style="height: 8rem">{{$plate->description_ingredients}}</p>
            {{-- Group button --}}
            <div class="d-flex flex-column">
                <a class="btn btn-primary" href="{{ route('admin.plates.show', ['plate'=> $plate->slug]) }}"><i
                        class="fas fa-pizza-slice"></i> Show</a>
                <a class="btn btn-secondary my-2" href="{{ route('admin.plates.edit', ['plate'=> $plate->slug]) }}"><i
                        class="fas fa-edit"></i> Edit</a>
                
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger " data-toggle="modal" data-target="{{'#delete_modal' . $plate->id}}">
                      <i class="fa fa-trash" aria-hidden="true"></i> Delete
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="{{'delete_modal' . $plate->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Plate</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure? 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form class="d-flex flex-column" action="{{route('admin.plates.destroy', ['plate'=> $plate->slug] )}}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
