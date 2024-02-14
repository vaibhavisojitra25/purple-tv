<?php

use App\Vpn;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VpnTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vpns = [
            [
                'country' => "Romania",
                'city' => "Buc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ro-buc.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Italy",
                'city' => "Mil",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/it-mil.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "New Zealand",
                'city' => "Auckland",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/180.149.231.119_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Finland",
                'city' => "Hel",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/fi-hel.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Dtw",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-dtw.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Colombia",
                'city' => "Bog",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/co-bog.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Canada",
                'city' => "Mon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ca-mon.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Chi",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-chi.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st002.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Hou",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-hou.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc-mp001.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Sng",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-sng-st003.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Chile",
                'city' => "San",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/cl-san.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Russia",
                'city' => "Spt",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ru-spt.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc-mp001.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "South Africa",
                'city' => "Jnb",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/za-jnb.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Korea, Republic of",
                'city' => "Seo",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/kr-seo.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Sng",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-sng-st002.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st002.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Linton Hall",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/23.105.163.94_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Clt",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-clt.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc-st003.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Switzerland",
                'city' => "Zur",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ch-zur.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Seattle",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/199.229.250.167_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Fra",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-fra-mp001.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Phx",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-phx.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Argentina",
                'city' => "Bua",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ar-bua.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Thailand",
                'city' => "Bkk",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/th-bkk.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "France",
                'city' => "Mrs",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/fr-mrs.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Nigeria",
                'city' => "Lag",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ng-lag.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Brazil",
                'city' => "Sao",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/br-sao.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "India",
                'city' => "Idr",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/in-idr.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Sfo",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-sfo-mp001.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Serbia",
                'city' => "Beg",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/rs-beg.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Latvia",
                'city' => "Rig",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/lv-rig.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Albania",
                'city' => "Tia",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/al-tia.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Chi",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-chi.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "France",
                'city' => "Bod",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/fr-bod.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc-st002.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Cyprus",
                'city' => "Nic",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/cy-nic.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Costa Rica",
                'city' => "Sjn",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/cr-sjn.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Azerbaijan",
                'city' => "Bak",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/az-bak.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Austria",
                'city' => "Vie",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/at-vie.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Austria",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Portugal",
                'city' => "Alfragide",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/5.154.174.117_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Greece",
                'city' => "Ath",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/gr-ath.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Moldova, Republic of",
                'city' => "Chi",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/md-chi.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Turkey",
                'city' => "Bur",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/tr-bur.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st003.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Mexico",
                'city' => "Mex",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/mx-mex.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Fra",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-fra-st002.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon-st005.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Dal",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-dal.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st007.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Canada",
                'city' => "Tor",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ca-tor.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Malaysia",
                'city' => "Kul",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/my-kul.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Sng",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-sng-st004.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Ukraine",
                'city' => "Iev",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ua-iev.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Philippines",
                'city' => "Mnl",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ph-mnl.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Italy",
                'city' => "Rom",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/it-rom.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Ireland",
                'city' => "Dub",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ie-dub.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Iceland",
                'city' => "Rkv",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/is-rkv.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Portugal",
                'city' => "Alfragide",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/176.61.146.84_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Costa Rica",
                'city' => "Sjn",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/cr-sjn.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Brazil",
                'city' => "Sao",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/br-sao.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Austria",
                'city' => "Vie",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/at-vie.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Sng",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-sng.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Croatia",
                'city' => "Zag",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/hr-zag.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Sng",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-sng-st004.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Romania",
                'city' => "Buc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ro-buc.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Clt",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-clt.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "France",
                'city' => "Par",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/fr-par.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Libyan Arab Jamahiriya",
                'city' => "Tip",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ly-tip.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Bos",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-bos.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Slovenia",
                'city' => "Lju",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/si-lju.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc-st005.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Seattle",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/198.8.80.87_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Muc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-muc.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Nue",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-nue.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Sweden",
                'city' => "Sto",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/se-sto.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Canada",
                'city' => "Tor",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ca-tor.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Canada",
                'city' => "North Vancouver",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/104.200.132.35_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Belgium",
                'city' => "Bru",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/be-bru.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Fra",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-fra-mp001.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Orl",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-orl.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Viet Nam",
                'city' => "Hcm",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/vn-hcm.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Korea, Republic of",
                'city' => "Seo",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/kr-seo.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Netherlands",
                'city' => "Ams",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/nl-ams-mp001.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Slovakia",
                'city' => "Bts",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sk-bts.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Slovakia",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon-st001.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Slovakia",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon-st003.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Bos",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-bos.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "India",
                'city' => "Chn",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/in-chn.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Serbia",
                'city' => "Beg",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/rs-beg.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Bosnia & Herzegovina",
                'city' => "Sarajevo",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/185.99.3.12_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Bosnia & Herzegovina",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon-mp001.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc-st002.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Thailand",
                'city' => "Bkk",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/th-bkk.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Lax",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-lax.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon-st002.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st001.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Portugal",
                'city' => "Opo",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/pt-opo.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Spain",
                'city' => "Bcn",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/es-bcn.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Ber",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-ber.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc-st003.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Spain",
                'city' => "Vlc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/es-vlc.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Mexico",
                'city' => "Mex",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/mx-mex.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Spain",
                'city' => "Bcn",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/es-bcn.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Portugal",
                'city' => "Lou",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/pt-lou.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Hong Kong",
                'city' => "Hkg",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/hk-hkg.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Hong Kong",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon-st002.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Bdn",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-bdn.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Bulgaria",
                'city' => "Sof",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/bg-sof.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Paraguay",
                'city' => "Asu",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/py-asu.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Paraguay",
                'city' => "Gla",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-gla.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Norway",
                'city' => "Osl",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/no-osl.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Canada",
                'city' => "Tor",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ca-tor-mp001.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc-st004.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon-st003.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Chile",
                'city' => "San",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/cl-san.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Nigeria",
                'city' => "Lag",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ng-lag.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Spain",
                'city' => "Mad",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/es-mad.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Fra",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-fra-st003.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Sng",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-sng-st001.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Atlanta",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/66.115.154.151_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "In",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-in.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Stl",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-stl.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Sfo",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-sfo.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Spain",
                'city' => "Mad",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/es-mad.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Iceland",
                'city' => "Rkv",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/is-rkv.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Iceland",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon-st005.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st005.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Hong Kong",
                'city' => "Hkg",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/hk-hkg.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Den",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-den.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Albania",
                'city' => "Tia",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/al-tia.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Linton Hall",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/23.105.163.94_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Fra",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-fra-st003.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Sng",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-sng-st001.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Denmark",
                'city' => "Copenhagen",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/45.12.221.163_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Australia",
                'city' => "Mel",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/au-mel.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Ireland",
                'city' => "Dub",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ie-dub.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Sng",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-sng-st003.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Czech Republic",
                'city' => "Prg",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/cz-prg.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "India",
                'city' => "Idr",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/in-idr.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Sfo",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-sfo.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Netherlands",
                'city' => "Ams",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/nl-ams.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st007.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Spain",
                'city' => "Vlc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/es-vlc.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Poland",
                'city' => "Gdn",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/pl-gdn.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Israel",
                'city' => "Tlv",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/il-tlv.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Israel",
                'city' => "Gla",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-gla.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "India",
                'city' => "Airoli",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/165.231.253.147_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Stl",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-stl.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Dal",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-dal.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Croatia",
                'city' => "Zag",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/hr-zag.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Lax",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-lax.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Norway",
                'city' => "Osl",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/no-osl.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Sfo",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-sfo-mp001.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Denmark",
                'city' => "Copenhagen",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/45.12.221.165_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Denmark",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon-st004.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Sweden",
                'city' => "Sto",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/se-sto.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Sweden",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon-st004.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Kazakhstan",
                'city' => "Ura",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/kz-ura.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Netherlands",
                'city' => "Ams",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/nl-ams.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Hungary",
                'city' => "Budapest",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/37.120.144.147_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Latvia",
                'city' => "Rig",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/lv-rig.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Netherlands",
                'city' => "Ams",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/nl-ams-mp001.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Sng",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-sng.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Portugal",
                'city' => "Opo",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/pt-opo.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Russia",
                'city' => "Mos",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ru-mos.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "France",
                'city' => "Par",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/fr-par.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Switzerland",
                'city' => "Zur",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ch-zur.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Belgium",
                'city' => "Bru",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/be-bru.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Poland",
                'city' => "Waw",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/pl-waw.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Fra",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-fra-st001.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Hungary",
                'city' => "Budapest",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/37.120.144.151_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Azerbaijan",
                'city' => "Bak",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/az-bak.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Turkey",
                'city' => "Ist",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/tr-ist.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Paraguay",
                'city' => "Asu",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/py-asu.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Portugal",
                'city' => "Alfragide",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/176.61.146.84_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Australia",
                'city' => "Sydney",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/144.48.39.69_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Finland",
                'city' => "Hel",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/fi-hel.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Italy",
                'city' => "Mil",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/it-mil.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st005.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Orl",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-orl.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Canada",
                'city' => "Tor",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ca-tor-mp001.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Cheektowaga",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/107.174.20.134_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Cheektowaga",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/107.174.20.130_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Cyprus",
                'city' => "Nic",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/cy-nic.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Poland",
                'city' => "Waw",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/pl-waw.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Poland",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Nue",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-nue.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Australia",
                'city' => "Adelaide",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/45.248.79.67_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Ukraine",
                'city' => "Iev",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ua-iev.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Muc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-muc.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Canada",
                'city' => "North Vancouver",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/104.200.132.37_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Moldova, Republic of",
                'city' => "Chi",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/md-chi.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Australia",
                'city' => "Syd",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/au-syd.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Macedonia, The Former Yugoslav Republic of",
                'city' => "Skp",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/mk-skp.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Bulgaria",
                'city' => "Sof",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/bg-sof.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Slovakia",
                'city' => "Bts",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sk-bts.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "San Jose",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/107.181.166.39_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "India",
                'city' => "Airoli",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/165.231.253.147_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Kan",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-kan.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Macedonia, The Former Yugoslav Republic of",
                'city' => "Skp",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/mk-skp.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Australia",
                'city' => "Per",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/au-per.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "New Zealand",
                'city' => "Auckland",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/180.149.231.119_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "France",
                'city' => "Bod",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/fr-bod.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Russia",
                'city' => "Mos",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ru-mos.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc-st005.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Russia",
                'city' => "Spt",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ru-spt.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Indonesia",
                'city' => "Jak",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/id-jak.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "South Africa",
                'city' => "Jnb",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/za-jnb.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st006.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Viet Nam",
                'city' => "Hcm",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/vn-hcm.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Dtw",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-dtw.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Estonia",
                'city' => "Tll",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ee-tll.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Italy",
                'city' => "Rom",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/it-rom.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Fra",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-fra.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st006.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc-st001.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Man",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-man.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Ltm",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-ltm.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Las",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-las.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Greece",
                'city' => "Ath",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/gr-ath.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Turkey",
                'city' => "Ist",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/tr-ist.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Bdn",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-bdn.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Taiwan, Province of China",
                'city' => "Tai",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/tw-tai.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "In",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-in.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon-st001.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United Arab Emirates",
                'city' => "Dub",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ae-dub.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Luxembourg",
                'city' => "Ste",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/lu-ste.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Slovenia",
                'city' => "Lju",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/si-lju.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Argentina",
                'city' => "Bua",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ar-bua.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Fra",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-fra-st002.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Lon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-lon-mp001.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Australia",
                'city' => "Syd",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/au-syd.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Australia",
                'city' => "Sydney",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/144.48.39.85_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Kazakhstan",
                'city' => "Ura",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/kz-ura.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Den",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-den.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Australia",
                'city' => "Per",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/au-per.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Turkey",
                'city' => "Bur",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/tr-bur.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc-st004.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Phx",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-phx.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st004.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Poland",
                'city' => "Gdn",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/pl-gdn.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Fra",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-fra-st001.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Colombia",
                'city' => "Bog",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/co-bog.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Las",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-las.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Tpa",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-tpa.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Atlanta",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/66.115.166.149_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Malaysia",
                'city' => "Kul",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/my-kul.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Nyc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-nyc-st001.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st001.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United Arab Emirates",
                'city' => "Dub",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ae-dub.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Mia",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-mia.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Sng",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-sng-mp001.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Australia",
                'city' => "Mel",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/au-mel.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Hou",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-hou.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Ber",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-ber.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Czech Republic",
                'city' => "Prg",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/cz-prg.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Tpa",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-tpa.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Mia",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-mia.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Philippines",
                'city' => "Mnl",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ph-mnl.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Australia",
                'city' => "Adelaide",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/45.248.79.69_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Israel",
                'city' => "Tlv",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/il-tlv.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Israel",
                'city' => "Man",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/uk-man.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Taiwan, Province of China",
                'city' => "Tai",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/tw-tai.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Indonesia",
                'city' => "Jak",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/id-jak.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Sng",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-sng-st002.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "France",
                'city' => "Mrs",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/fr-mrs.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Ltm",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-ltm.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Kan",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-kan.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Libyan Arab Jamahiriya",
                'city' => "Tip",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ly-tip.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Estonia",
                'city' => "Tll",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ee-tll.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Bosnia & Herzegovina",
                'city' => "Sarajevo",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/185.99.3.7_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Portugal",
                'city' => "Alfragide",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/5.154.174.65_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Slc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-slc.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Canada",
                'city' => "Mon",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/ca-mon.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "India",
                'city' => "Chn",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/in-chn.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Luxembourg",
                'city' => "Ste",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/lu-ste.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Germany",
                'city' => "Fra",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/de-fra.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st004.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "San Jose",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/107.181.166.55_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Portugal",
                'city' => "Lou",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/pt-lou.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "United States",
                'city' => "Slc",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/us-slc.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Japan",
                'city' => "Tok",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/jp-tok-st003.prod.surfshark.com_tcp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'country' => "Singapore",
                'city' => "Sng",
                'file_url' => "https://xvpn.b-cdn.net/ovpn/sg-sng-mp001.prod.surfshark.com_udp.ovpn",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        Vpn::insert($vpns);
    }
}
