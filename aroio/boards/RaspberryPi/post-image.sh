#!/bin/bash

set -e

BOARD_DIR="$(dirname $0)"
BOARD_NAME="$(basename ${BOARD_DIR})"
GENIMAGE_CFG="${BOARD_DIR}/genimage-${BOARD_NAME}.cfg"
GENIMAGE_TMP="${BUILD_DIR}/genimage.tmp"

# Fix wrong console in cmdline.txt
echo 'root=/dev/ram0 rootwait console=ttyAMA0,115200 console=tty2' > "${BINARIES_DIR}/rpi-firmware/cmdline.txt"

# Include cpio fs option, might be better do do this elsewhere though..
echo "Writing a config.txt with aroio specific options."
cat << __EOF__ > "${BINARIES_DIR}/rpi-firmware/config.txt"

kernel=zImage
display_rotate=1
force_turbo=1
dtdebug=1
max_usb_current=1
disable_splash=1
dtparam=i2c_arm=on
dtoverlay=i2s-mmap
dtoverlay=hifiberry-dacplus
dtparam=spi=on
dtoverlay=gpio-ir,gpio_pin=25
disable_overscan=1
dtoverlay=pi3-disable-wifi
dtoverlay=pi3-disable-bt
dtoverlay=pi3-act-led,gpio=22
dtparam=act_led_trigger=heartbeat

__EOF__

for arg in "$@"
do
	case "${arg}" in
		--add-pi3-miniuart-bt-overlay)
		if ! grep -qE '^dtoverlay=' "${BINARIES_DIR}/rpi-firmware/config.txt"; then
			echo "Adding 'dtoverlay=pi3-miniuart-bt' to config.txt (fixes ttyAMA0 serial console)."
			cat << __EOF__ >> "${BINARIES_DIR}/rpi-firmware/config.txt"

# fixes rpi3 ttyAMA0 serial console
dtoverlay=pi3-miniuart-bt
__EOF__
		fi
		;;
		--aarch64)
		# Run a 64bits kernel (armv8)
		sed -e '/^kernel=/s,=.*,=Image,' -i "${BINARIES_DIR}/rpi-firmware/config.txt"
		if ! grep -qE '^arm_control=0x200' "${BINARIES_DIR}/rpi-firmware/config.txt"; then
			cat << __EOF__ >> "${BINARIES_DIR}/rpi-firmware/config.txt"

# enable 64bits support
arm_control=0x200
__EOF__
		fi

		# Enable uart console
		if ! grep -qE '^enable_uart=1' "${BINARIES_DIR}/rpi-firmware/config.txt"; then
			cat << __EOF__ >> "${BINARIES_DIR}/rpi-firmware/config.txt"

# enable rpi3 ttyS0 serial console
enable_uart=1
__EOF__
		fi
		;;
		--gpu_mem_256=*|--gpu_mem_512=*|--gpu_mem_1024=*)
		# Set GPU memory
		gpu_mem="${arg:2}"
		sed -e "/^${gpu_mem%=*}=/s,=.*,=${gpu_mem##*=}," -i "${BINARIES_DIR}/rpi-firmware/config.txt"
		;;
	esac

done

rm -rf "${GENIMAGE_TMP}"

genimage                           \
	--rootpath "${TARGET_DIR}"     \
	--tmppath "${GENIMAGE_TMP}"    \
	--inputpath "${BINARIES_DIR}"  \
	--outputpath "${BINARIES_DIR}" \
	--config "${GENIMAGE_CFG}"

exit $?
