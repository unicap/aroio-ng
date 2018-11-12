
################################################################################
#
# jack_minimix
#
################################################################################

JACK_MINIMIX_VERSION = b529bb3affc951d68229c32d7d3ea4dd844db0bc
JACK_MINIMIX_SOURCE = jack-minimix-$(JACK_MINIMIX_VERSION).tar.gz
JACK_MINIMIX_SITE = $(call github,njh,jackminimix,$(JACK_MINIMIX_VERSION))

JACK_MINIMIX_LICENSE = LGPLv2.1+
JACK_MINIMIX_LICENSE_FILES = COPYING
#JACK_MINIMIX_INSTALL_STAGING = YES
JACK_MINIMIX_INSTALL_TARGET = YES
JACK_MINIMIX_AUTORECONF=YES

$(eval $(autotools-package))


