################################################################################
#
# perl-enum
#
################################################################################

PERL_ENUM_VERSION = 1.11
PERL_ENUM_SOURCE = enum-$(PERL_ENUM_VERSION).tar.gz
PERL_ENUM_SITE = $(BR2_CPAN_MIRROR)/authors/id/N/NE/NEILB
PERL_ENUM_LICENSE = Artistic or GPL-1.0+
PERL_ENUM_LICENSE_FILES = README

$(eval $(perl-package))
