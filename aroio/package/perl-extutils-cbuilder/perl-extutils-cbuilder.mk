################################################################################
#
# perl-extutils-cbuilder
#
################################################################################

PERL_EXTUTILS_CBUILDER_VERSION = 0.280230
PERL_EXTUTILS_CBUILDER_SOURCE = ExtUtils-CBuilder-$(PERL_EXTUTILS_CBUILDER_VERSION).tar.gz
PERL_EXTUTILS_CBUILDER_SITE = $(BR2_CPAN_MIRROR)/authors/id/A/AM/AMBS
PERL_EXTUTILS_CBUILDER_LICENSE = Artistic or GPL-1.0+
PERL_EXTUTILS_CBUILDER_LICENSE_FILES = LICENSE

$(eval $(perl-package))
