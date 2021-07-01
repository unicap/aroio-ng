$(document).ready(function() {
    if (window.location.pathname == "/index.php") {
        audio_select = document.getElementById("audio_output").children[0];
        audio_select.addEventListener("change", audio_output_changed);

        raw_player_select = document.getElementsByName("RAW_PLAYER")[0];
        raw_player_select.addEventListener("change", adjust_lms);

        squeezelite_checkbox = document.getElementsByName("JACK_SQUEEZELITE")[1];
        squeezelite_checkbox.addEventListener("change", adjust_lms);

        lan_dhcp_on = document.getElementsByName("LAN_DHCP")[0];
        lan_dhcp_on.addEventListener("click", adjust_dhcp);
        lan_dhcp_off = document.getElementsByName("LAN_DHCP")[1];
        lan_dhcp_off.addEventListener("click", adjust_dhcp);

        platform_select = document.getElementsByName("PLATFORM")[0];
        platform_select.addEventListener("change", adjust_onboard_wifi);

        adjust_audio_matrix();
        adjust_sample_rate_select();
        adjust_lms();
        adjust_dhcp();
        adjust_wifi();
        adjust_onboard_wifi();
    }

    if (window.location.pathname == "/system.php") {
        var update_modal = document.getElementById("update_modal");
        if (update_modal != null) {
            // This gets called as soon as the page is ready (i.e. update is finished)
            finish_update();
        }
    }

    if (window.location.pathname == "/brutefir.php") {
        var current_output = document.getElementById("convolver_settings").dataset.output;
        if (current_output == "jack-bf" || current_output == "jack-bfms") {
            $("#convolver_settings *").prop("disabled", false);
        } else {
            $("#convolver_settings *").prop("disabled", true);
        }
    }
});

// Triggered when the audio output is changed
function audio_output_changed() {
    adjust_audio_matrix();
    adjust_sample_rate_select();
    adjust_lms();
}

function adjust_audio_matrix() {
    reset_audio_matrix();
    var selected_output = audio_select.value;
    switch(selected_output) {
        case "vol-plug":
            var help_direct = document.getElementById("help_audio_output").dataset.direct;
            document.getElementById("help_audio_output").setAttribute("title", help_direct);
            document.getElementById("player_raw").classList.remove("d-none");
            break;
        case "jack":
            var help_bus = document.getElementById("help_audio_output").dataset.bus;
            document.getElementById("help_audio_output").setAttribute("title", help_bus);
            document.getElementById("output_headline_title").classList.remove("d-none");
            document.getElementById("output_headline").classList.remove("d-none");
            document.getElementById("output_mixer").classList.remove("d-none");
            break;
        case "jack-bf":
            var help_convol = document.getElementById("help_audio_output").dataset.convol;
            document.getElementById("help_audio_output").setAttribute("title", help_convol);
            document.getElementById("output_headline_title").classList.remove("d-none");
            document.getElementById("output_headline").classList.remove("d-none");
            document.getElementById("output_mixer").classList.remove("d-none");
            break;
    }
}

function reset_audio_matrix() {
    document.getElementById("player_raw").classList.add("d-none");

    document.getElementById("output_headline_title").classList.add("d-none");
    document.getElementById("output_headline").classList.add("d-none");

    document.getElementById("output_mixer").classList.add("d-none");

    document.getElementById("help_audio_output").setAttribute("title", "");
}

// Shows/hides both sample rate select and hint depending on chosen output
function adjust_sample_rate_select() {
    let rate_select = document.getElementsByName("RATE")[0];
    let rate_direct = document.getElementById("rate_direct");
    let selected_output = audio_select.value;
    if (selected_output == "vol-plug" || selected_output == "vol-plug-ms") {
        rate_select.classList.add("d-none");
        rate_direct.classList.remove("d-none");
    } else {
        rate_select.classList.remove("d-none");
        rate_direct.classList.add("d-none");
    }
}

function adjust_lms() {
    let selected_output = audio_select.value;
    let raw_player = raw_player_select.value;
    let squeeze_enabled = squeezelite_checkbox.checked;

    if (selected_output == "vol-plug" || selected_output == "vol-plug-ms") {
        if (raw_player == "squeezelite") {
            $("#lms_settings *").prop("disabled", false);
        } else {
            $("#lms_settings *").prop("disabled", true);
        }

    } else {
        if (squeeze_enabled) {
            $("#lms_settings *").prop("disabled", false);
        } else {
            $("#lms_settings *").prop("disabled", true);
        }
    }
}

function adjust_dhcp() {
    let lan_dhcp = document.querySelector('input[name=LAN_DHCP]:checked').value;
    let lan_ipaddr = document.getElementById("lan_ipaddr");
    let lan_netmask = document.getElementById("lan_netmask");
    let lan_dnsserv = document.getElementById("lan_dnsserv");
    let lan_gateway = document.getElementById("lan_gateway");
    let wifi_scan = document.getElementById("wifi_scan");
    let wifi_ssid = document.getElementById("wifi_ssid");
    let wifi_pass = document.getElementById("wifi_pass");
    if (lan_dhcp == "ON") {
        lan_ipaddr.classList.add("d-none");
        lan_netmask.classList.add("d-none");
        lan_dnsserv.classList.add("d-none");
        lan_gateway.classList.add("d-none");
        wifi_scan.classList.remove("d-none");
        wifi_ssid.classList.remove("d-none");
        wifi_pass.classList.remove("d-none");
    } else {
        lan_ipaddr.classList.remove("d-none");
        lan_netmask.classList.remove("d-none");
        lan_dnsserv.classList.remove("d-none");
        lan_gateway.classList.remove("d-none");
        wifi_scan.classList.add("d-none");
        wifi_ssid.classList.add("d-none");
        wifi_pass.classList.add("d-none");
    }
}

function adjust_wifi() {
    let wifi_state = document.getElementById("network_table").dataset.wifi_enabled;
    if (wifi_state == "enabled") {
        $("#wifi_scan *").prop("disabled", false);
        $("#wifi_ssid *").prop("disabled", false);
        $("#wifi_pass *").prop("disabled", false);
    } else {
        $("#wifi_scan *").prop("disabled", true);
        $("#wifi_ssid *").prop("disabled", true);
        $("#wifi_pass *").prop("disabled", true);
    }
}

function adjust_onboard_wifi() {
    if (platform_select.value == "RaspberryPi") {
        $("#onboard_wifi *").prop("disabled", false);
    } else {
        $("#onboard_wifi *").prop("disabled", true);
    }
}

function finish_update() {
    document.getElementById("update_progress").classList.add("d-none");
    document.getElementById("update_finished").classList.remove("d-none");
    setTimeout(function() {
        window.location = "/index.php";
    }, 10000);
}

// Checkbox zum Passwort anzeigen
function machText(chk, frm) {
    var p = frm.newpass;
    try {
        var val = p.value;
        p.type = chk ? 'text':'password';
        p.value = val; //benötigt z. B. in Opera
    }
    catch (e) {
        var neuInp=document.createElement('input');
        neuInp.type = chk ? 'text':'password';
        neuInp.value = p.value;
        neuInp.name = neuInp.id = 'newpass';
        p.parentNode.replaceChild(neuInp,p);
    }
}