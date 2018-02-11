################################################################################
#
# perl-readonly
#
################################################################################

PERL_READONLY_VERSION = 2.05
PERL_READONLY_SOURCE = Readonly-$(PERL_READONLY_VERSION).tar.gz
PERL_READONLY_SITE = $(BR2_CPAN_MIRROR)/authors/id/S/SA/SANKO
PERL_READONLY_DEPENDENCIES = host-perl-module-build-tiny
PERL_READONLY_LICENSE = Artistic-2.0
PERL_READONLY_LICENSE_FILES = LICENSE

$(eval $(perl-package))
