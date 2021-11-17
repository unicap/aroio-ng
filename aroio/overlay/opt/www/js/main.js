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

        document.getElementById("show_password_icon").addEventListener("click", show_password);
        document.getElementById("lms_credentials_checkbox").addEventListener("change", toggle_lms_credentials);

        adjust_audio_matrix();
        adjust_sample_rate_select();
        adjust_lms();
        adjust_lms_credential_fields();
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

    if (window.location.pathname == "/measurement.php") {
        var noise_modal = document.getElementById("noise_modal");
        var measurement_modal = document.getElementById("measurement_modal");
        if (noise_modal != null) {
            setTimeout(function() {
                window.location = "/measurement.php";
            }, 15000);
        }
        if (measurement_modal != null) {
            document.getElementsByName("CANCEL_MEASUREMENT")[0].classList.add("d-none");
            document.getElementById("measurement_finished").classList.remove("d-none");
            document.getElementById("measurement_close").addEventListener("click", function() {
                window.location = "/measurement.php";
            })
        }
    }

    if (window.location.pathname == "/brutefir.php") {
        var current_output = document.getElementById("convolver_settings").dataset.output;
        if (current_output == "jack-bf" || current_output == "jack-bfms") {
            $("#convolver_settings *").prop("disabled", false);
            document.getElementById("convolver_notification").classList.add("d-none");
        } else {
            $("#convolver_settings *").prop("disabled", true);
            document.getElementById("convolver_notification").classList.remove("d-none");
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

// Show/hide LMS credential fields
function adjust_lms_credential_fields() {
    let lms_credentials_checkbox = document.getElementById("lms_credentials_checkbox");
    let lms_usr_input = document.getElementById("lms_usr_input");
    let lms_usr_row = document.getElementById("lms_usr_row");
    let lms_pwd_row = document.getElementById("lms_pwd_row");
    if (lms_usr_input.value == "" ) {
        lms_credentials_checkbox.checked = false;
        lms_usr_row.classList.add("d-none");
        lms_pwd_row.classList.add("d-none");
    } else {
        lms_credentials_checkbox.checked = true;
        lms_usr_row.classList.remove("d-none");
        lms_pwd_row.classList.remove("d-none");
    }
}

function toggle_lms_credentials() {
    document.getElementById("lms_usr_row").classList.toggle("d-none");
    document.getElementById("lms_pwd_row").classList.toggle("d-none");
}

// Display/hide password (used for WIFI)
function show_password() {
    var input = document.getElementById("newpass");
    if (input.type == "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}
