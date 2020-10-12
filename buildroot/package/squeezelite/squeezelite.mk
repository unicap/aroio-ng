################################################################################
#
# squeezelite
#
################################################################################

#SQUEEZELITE_VERSION = c503edc9acb203f0c12865447fe6963fd8220fb8
SQUEEZELITE_VERSION = 201358383f8e87b92d248c07e4a0eedaa7b1754d
SQUEEZELITE_SITE = $(call github,ralph-irving,squeezelite,$(SQUEEZELITE_VERSION))
SQUEEZELITE_LICENSE = GPL-3.0
SQUEEZELITE_LICENSE_FILES = LICENSE.txt
SQUEEZELITE_DEPENDENCIES = alsa-lib flac libmad libvorbis mpg123
SQUEEZELITE_MAKE_OPTS = -DLINKALL

ifeq ($(BR2_PACKAGE_ALAC_DECODER),y)
SQUEEZELITE_DEPENDENCIES += alac-decoder
SQUEEZELITE_MAKE_OPTS += -DALAC
SQUEEZELITE_MAKE_OPTS += -I$(STAGING_DIR)/usr/include/alac
endif

ifeq ($(BR2_PACKAGE_OPUS),y)
SQUEEZELITE_DEPENDENCIES += opus
SQUEEZELITE_MAKE_OPTS += -DOPUS
SQUEEZELITE_MAKE_OPTS += -I$(STAGING_DIR)/usr/include/opus
endif

ifeq ($(BR2_PACKAGE_FAAD2),y)
SQUEEZELITE_DEPENDENCIES += faad2
else
SQUEEZELITE_MAKE_OPTS += -DNO_FAAD
endif

ifeq ($(BR2_PACKAGE_SQUEEZELITE_FFMPEG),y)
SQUEEZELITE_DEPENDENCIES += ffmpeg
SQUEEZELITE_MAKE_OPTS += -DFFMPEG
endif

ifeq ($(BR2_PACKAGE_SQUEEZELITE_DSD),y)
SQUEEZELITE_MAKE_OPTS += -DDSD
endif

ifeq ($(BR2_PACKAGE_SQUEEZELITE_LIRC),y)
SQUEEZELITE_DEPENDENCIES += lirc-tools
SQUEEZELITE_MAKE_OPTS += -DIR
endif

ifeq ($(BR2_PACKAGE_SQUEEZELITE_RESAMPLE),y)
SQUEEZELITE_DEPENDENCIES += libsoxr
SQUEEZELITE_MAKE_OPTS += -DRESAMPLE
endif

ifeq ($(BR2_PACKAGE_SQUEEZELITE_VISEXPORT),y)
SQUEEZELITE_MAKE_OPTS += -DVISEXPORT
endif

ifeq ($(BR2_PACKAGE_WIRINGPI),y)
SQUEEZELITE_DEPENDENCIES += wiringpi
SQUEEZELITE_MAKE_OPTS += -DRPI
endif

define SQUEEZELITE_BUILD_CMDS
	$(TARGET_MAKE_ENV) $(MAKE) $(TARGET_CONFIGURE_OPTS) \
		OPTS="$(SQUEEZELITE_MAKE_OPTS)" -C $(@D) all
endef

define SQUEEZELITE_INSTALL_TARGET_CMDS
	$(INSTALL) -D -m 0755 $(@D)/squeezelite \
		$(TARGET_DIR)/usr/bin/squeezelite
endef

$(eval $(generic-package))

#libasound2-dev libflac-dev libmad0-dev libvorbis-dev libmpg123-dev libfaad-dev libsox-dev libsoxr-dev libavformat-dev
#-DOPUS -DALAC
