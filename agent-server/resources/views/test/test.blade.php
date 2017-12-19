@foreach( $listclient as $lc)
    Cliente: {{ $lc->cli_name }}
    Ambiente: {{ $lc->cli_env }}
    Versão: {{ $lc->cli_version_system }}
    Agent Data Update: {{ date('d.m.Y', strtotime($lc->updated_at)) }}
    Agent Time Update: {{ date('H:i:s', strtotime($lc->updated_at)) }}
    Configuações: {{ $lc->config_properties }}
@endforeach