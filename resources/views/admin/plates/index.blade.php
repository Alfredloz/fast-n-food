@extends('layouts.dashboard')

@section('content')

<div class="custom_center">
    <h2>Menu</h2>
    <a class="btn btn_add" href="{{ route('admin.plates.create') }}" role="button">Aggiungi piatto</a>
</div>

<div class="plates_list">
    @foreach ($plates as $plate)

    {{-- Card plate --}}
    <div class="plate_card">

        {{-- Image plate --}}
        <div class="plate_img">
            @if ($plate->picture)
            <img src="{{ asset('storage/' . $plate->picture) }}" alt="">
            @else
            <img src="{{ asset('images/plate_ph.png') }}" alt="">
            @endif
        </div>

        {{-- Info plate --}}
        <div class="plate_info">
            <h3>{{$plate->name}}</h3>

            {{-- Visibility form --}}
            <form class="visibility-form" id="{{$plate->id}}" action="{{route('admin.plates.visibility', ['plate' => $plate->slug]) }}"
                method="post">
                @csrf
                @method('PUT')
                {{-- Input radio visibility --}}
                <div class="form-check form-check-block">
                    <div class="form-block">
                        <input type="radio" class="form-check-input" name="visibility" value="1"
                            onclick="this.form.submit()" {{ $plate->visibility ? 'checked' : '' }}>
                        <label for="visibility" class="form-check-label">Disponibile</label>
                    </div>
                    <div class="form-block">
                        <input type="radio" class="form-check-input" name="visibility" value="0"
                            onclick="this.form.submit()" {{ $plate->visibility ? '' : 'checked'  }}>
                        <label for="visibility" class="form-check-label">Non Disponibile</label>
                    </div>
                </div>
            </form>

            {{-- Description Plate --}}
            <p>{{$plate->description_ingredients}}</p>

            {{-- Group button --}}
            <div class="group_button">
                <a class="btn btn_show" href="{{ route('admin.plates.show', ['plate'=> $plate->slug]) }}"><i
                        class="fas fa-pizza-slice"></i> Piatto</a>
                <a class="btn btn_edit mi2" href="{{ route('admin.plates.edit', ['plate'=> $plate->slug]) }}"><i
                        class="fas fa-edit"></i> Modifica</a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger " data-toggle="modal"
                    data-target="{{'#delete_modal' . $plate->id}}">
                    <i class="fa fa-trash" aria-hidden="true"></i> Cancella
                </button>

                <!-- Modal -->
                <div class="modal fade" id="{{'delete_modal' . $plate->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cancella il piatto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Sei sicuro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                                <form class="d-flex flex-column"
                                    action="{{route('admin.plates.destroy', ['plate'=> $plate->slug] )}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>
                                        Cancella definitivamente</button>
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
