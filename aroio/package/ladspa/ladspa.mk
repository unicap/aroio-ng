#############################################################
#
# lasdpa
#
#############################################################
LADSPA_VERSION = 692b4001120aea16385d74ce86b0865c6ce7fdf5
LADSPA_SOURCE = ladspa-$(LADSPA_VERSION).tar.gz
LADSPA_SITE = $(call github,swh,ladspa,$(LADSPA_VERSION))
LADSPA_AUTORECONF = YES
LADSPA_AUTORECONF_OPTS = -i
LADSPA_GETTEXTIZE = YES
LADSPA_INSTALL_STAGING = NO


LADSPA_DEPENDENCIES = host-gettext $(TARGET_NLS_DEPENDENCIES) host-perl-list-moreutils host-perl-exporter-tiny host-libxml-parser-perl
#LADSPA_CONF_OPTS = --prefix=/usr --disable-nls --disable-rpath

LADSPA_SECTION = audio
LADSPA_DESCRIPTION = Steve Harris LADSPA plugins


define LADSPA_PRE_CONFIGURE_FIXUP
	mkdir -p $(@D)/m4
#	touch $(@D)/ABOUT-NLS
#	touch $(@D)/config.rpath
endef


#LADSPA_PRE_CONFIGURE_HOOKS += LADSPA_PRE_CONFIGURE_FIXUP

$(eval $(autotools-package))
