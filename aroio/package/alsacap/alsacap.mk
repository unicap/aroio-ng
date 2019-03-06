################################################################################
#
# alsacap
#
################################################################################
ALSACAP_VERSION = 05968d33bd42b9550ac0892c0214edc956d09d8d
ALSACAP_SITE = $(call github,bubbapizza,alsacap,$(ALSACAP_VERSION))
ALSACAP_LICENSE = ISC licence
ALSACAP_LICENSE_FILES = COPYING
ALSACAP_DEPENDENCIES = alsa-lib

define ALSACAP_BOOTSTRAP
    cd $(@D) && ./bootstrap
endef

ALSACAP_PRE_CONFIGURE_HOOKS += ALSACAP_BOOTSTRAP

$(eval $(autotools-package))