//SCRIPT PARA MODIFICACIÓN VISUAL DE VENTANAS Y TRATAMIENTO DE DATOS
//
// Por Alejandro Valero
//
// v0.3 (ALPHA)

GLOBAL = {
	update_hold : false,
	previo : "inicio",
	}

function abre_frame(allScreen){
	GLOBAL.update_hold = true;
	GLOBAL.previo="frame";

	$('#p_dash').hide();
	$('.mainpanel').css("height","100%");
	$('.contentpanel').css("padding","0px");
	$('iFrame').show();
	if(allScreen){ $('#menuToggle').click(); }; //ventana completa
}

function inicio(){
	GLOBAL.update_hold = false;

	if(GLOBAL.previo=="inicio"){
		console.log("ya estas en inicio");
		return;
	}else{
		GLOBAL.previo="inicio";
	};

	$('iFrame').attr("src","");
	$('iFrame').hide();
	$('.contentpanel').css("padding","20px");
	$('#p_dash').show();
	
	//Arranca todo
	appstat_btsync();
	appstat_couchpotato();
	appstat_deluged();
	appstat_delugeweb();
	appstat_emby();
	appstat_flood();
	appstat_headphones();
	appstat_irssi();
	appstat_jackett();
	appstat_lounge();
	appstat_medusa();
	appstat_netdata();
	appstat_nextcloud();
	appstat_nzbget();
	appstat_nzbhydra();
	appstat_ombi();
	appstat_openvpn();
	appstat_plex();
	appstat_tautulli();
	appstat_pyload();
	appstat_quassel();
	appstat_radarr();
	//appstat_rapidleech();
	appstat_rtorrent();
	appstat_sabnzbd();
	appstat_sickgear();
	appstat_sickchill();
	appstat_sonarr();
	appstat_subsonic();
	appstat_syncthing();
	appstat_webconsole();
	appstat_x2go();
	appstat_znc();
	appstat_bazarr();
	appstat_lidarr();
	uptime();
	sload();
	bwtables();
	diskstats();
	ramstats();
	//activefeed();
	msgoutput();
	GetData();
	fetchData();
	act_cpu_freq();
	getJSONData();	
}

function logout() {
        // To invalidate a basic auth login:
        //
        //      1. Call this logout function.
        //      2. It makes a GET request to an URL with false Basic Auth credentials
        //      3. The URL returns a 401 Unauthorized
        //      4. Forward to some "you-are-logged-out"-page
        //      5. Done, the Basic Auth header is invalid now
        jQuery.ajax({
            type: "GET",
            url: "#",
            async: false,
            username: "logmeout",
            password: "123456",
            headers: { "Authorization": "Basic xxx" }
        })
        .done(function(){
            // If we don't get an error, we actually got an error as we expect an 401!
        })
        .fail(function(){
            // We expect to get an 401 Unauthorized error! In this case we are successfully
            // logged out and we redirect the user.
	    document.body.innerHTML = "";
            window.location = "index.php";
    });

    return false;
}