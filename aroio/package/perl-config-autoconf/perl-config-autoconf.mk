################################################################################
#
# perl-config-autoconf
#
################################################################################

PERL_CONFIG_AUTOCONF_VERSION = 0.316
PERL_CONFIG_AUTOCONF_SOURCE = Config-AutoConf-$(PERL_CONFIG_AUTOCONF_VERSION).tar.gz
PERL_CONFIG_AUTOCONF_SITE = $(BR2_CPAN_MIRROR)/authors/id/R/RE/REHSACK
HOST_PERL_CONFIG_AUTOCONF_DEPENDENCIES = host-perl-capture-tiny
PERL_CONFIG_AUTOCONF_LICENSE = Artistic or GPL-1.0+
PERL_CONFIG_AUTOCONF_LICENSE_FILES = ARTISTIC-1.0 LICENSE

$(eval $(host-perl-package))
