@extends('simple-layout')

@section('content')

    <div class="container very-small">

        <div class="my-l">&nbsp;</div>

        <div class="card content-wrap">
            <h1 class="list-heading">{{ title_case(trans('auth.log_in')) }}</h1>

            <form action="{{ baseUrl('/login') }}" method="POST" id="login-form" class="mt-l">
                {!! csrf_field() !!}

                <div class="stretch-inputs">
                    @include('auth.forms.login.' . $authMethod)
                </div>

                <div class="grid half right-focus collapse-xs gap-xl v-center">
                    <div class="text-left ml-xxs">
                        @include('components.custom-checkbox', [
                            'name' => 'remember',
                            'checked' => false,
                            'value' => 'on',
                            'label' => trans('auth.remember_me'),
                        ])
                    </div>
                    <div class="text-right">
                        @if($authMethod === 'standard' && setting('registration-enabled', false))
                            <a class="button outline" href="{{ baseUrl('/register') }}">{{ trans('auth.sign_up') }}</a>
                        @endif
                        <button class="button primary" tabindex="3">{{ title_case(trans('auth.log_in')) }}</button>
                    </div>
                </div>

            </form>

            @if(count($socialDrivers) > 0)
                <hr class="my-l">
                @foreach($socialDrivers as $driver => $name)
                    <div>
                        <a id="social-login-{{$driver}}" class="button outline block svg" href="{{ baseUrl("/login/service/" . $driver) }}">
                            @icon('auth/' . $driver)
                            {{ trans('auth.log_in_with', ['socialDriver' => $name]) }}
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

@stop