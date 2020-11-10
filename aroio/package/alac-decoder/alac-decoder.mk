################################################################################
#
# alac-decoder
#
################################################################################

ALAC_DECODER_VERSION = 69477ef7275c4a4af039af0c959762f29728c6ba
ALAC_DECODER_SOURCE = alac-$(ALAC_DECODER_VERSION_VERSION).tar.gz
ALAC_DECODER_SITE = $(call github,TimothyGu,alac,$(ALAC_DECODER_VERSION))
ALAC_DECODER_INSTALL_STAGING = YES
#LIBFOO_INSTALL_STAGING_OPTS = 
ALAC_DECODER_INSTALL_TARGET = YES
ALAC_DECODER_AUTORECONF = YES
ALAC_DECODER_AUTORECONF_OPTS = -i -f
# ALAC_DECODER_CONF_OPTS = --disable-shared
# ALAC_DECODER_DEPENDENCIES = libglib2 host-pkgconf

define ALAC_INSTALL_STAGING_CMDS
	$(INSTALL) -D -m 644 $(@D)/codec/ALACDecoder.h  $(STAGING_DIR)/usr/include/ALACDecoder.h
endef

$(eval $(autotools-package))
