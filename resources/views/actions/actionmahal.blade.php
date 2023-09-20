<div class="d-flex">
    <a href="{{ route('mahals.edit', ['mahal' => $mahal->id]) }}" class="btn btn-outline-primary btn-sm me-2"><i class="bi-pencil-square"></i></a>

    <div>
        <form action="{{ route('mahals.destroy', ['mahal' => $mahal->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-outline-danger btn-sm me-2 btn-delete">
                <i class="bi-trash"></i>
            </button>
        </form>

    </div>
</div>
