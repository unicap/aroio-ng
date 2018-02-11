################################################################################
#
# perl-exporter-lite
#
################################################################################

PERL_EXPORTER_LITE_VERSION = 0.08
PERL_EXPORTER_LITE_SOURCE = Exporter-Lite-$(PERL_EXPORTER_LITE_VERSION).tar.gz
PERL_EXPORTER_LITE_SITE = $(BR2_CPAN_MIRROR)/authors/id/N/NE/NEILB
PERL_EXPORTER_LITE_LICENSE = Artistic or GPL-1.0+
PERL_EXPORTER_LITE_LICENSE_FILES = README

$(eval $(perl-package))
