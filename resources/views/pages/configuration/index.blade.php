@extends('pages.configuration.master')
@section('configuration')
    @parent
    <form action="{{ route('admin.configuration.update', $config->id) }}" method="POST">
        @csrf
        @method('PUT')
        <fieldset class="form-group row">
            <legend class="col-form-label col-sm-2 float-sm-left pt-0">Operating System</legend>
            <div class="col-sm-10">
                <div class="form-check">
                <input class="form-check-input" type="radio" name="OS" id="os_windows" value="WINDOWS 10" {{$config->OS == 'WINDOWS 10' ? 'checked':''}}>
                <label class="form-check-label" for="os_windows">
                    Windows 10
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="OS" id="os_linuxubuntu" value="LINUX/ UBUNTU" {{$config->OS == 'LINUX/ UBUNTU' ? 'checked':''}}>
                <label class="form-check-label" for="os_linuxubuntu">
                    Linux/ Ubuntu
                </label>
                </div>
            </div>
        </fieldset>
        <div class="form-group row mt-3">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
    </form>
@endsection