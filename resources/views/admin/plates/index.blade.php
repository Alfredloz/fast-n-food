@extends('layouts.dashboard')

@section('content')

<h2>Menu</h2>

<a class="btn btn-primary mt-5" href="{{ route('admin.plates.create') }}" role="button">Add a plate</a>

<div class="d-flex flex-wrap">
    @foreach ($plates as $plate)

    {{-- Card plate --}}
    <div class="card mr-3 mt-5" style="width: 16rem;">
        <img class="card-img-top" style="height: 10rem" src="{{ asset('storage/' . $plate->picture) }}" alt="">
        <div class="card-body">
            <h5 class="card-title">{{$plate->name}}</h5>

            {{-- Visibility form --}}
            <form id="{{$plate->id}}" action="{{route('admin.plates.visibility', ['plate' => $plate->id]) }}"
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
                <a class="btn btn-primary" href="{{ route('admin.plates.show', ['plate'=> $plate->id]) }}"><i
                        class="fas fa-pizza-slice"></i> Show</a>
                <a class="btn btn-secondary my-2" href="{{ route('admin.plates.edit', ['plate'=> $plate->id]) }}"><i
                        class="fas fa-edit"></i> Edit</a>
                <form class="d-flex flex-column" action="{{route('admin.plates.destroy', ['plate'=> $plate->id] )}}"
                    method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
