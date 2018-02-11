################################################################################
#
# perl-carp-assert
#
################################################################################

PERL_CARP_ASSERT_VERSION = 0.21
PERL_CARP_ASSERT_SOURCE = Carp-Assert-$(PERL_CARP_ASSERT_VERSION).tar.gz
PERL_CARP_ASSERT_SITE = $(BR2_CPAN_MIRROR)/authors/id/N/NE/NEILB
PERL_CARP_ASSERT_LICENSE = Artistic or GPL-1.0+
PERL_CARP_ASSERT_LICENSE_FILES = README

$(eval $(perl-package))
