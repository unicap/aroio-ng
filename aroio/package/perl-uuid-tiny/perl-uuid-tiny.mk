################################################################################
#
# perl-uuid-tiny
#
################################################################################

PERL_UUID_TINY_VERSION = 1.04
PERL_UUID_TINY_SOURCE = UUID-Tiny-$(PERL_UUID_TINY_VERSION).tar.gz
PERL_UUID_TINY_SITE = $(BR2_CPAN_MIRROR)/authors/id/C/CA/CAUGUSTIN
PERL_UUID_TINY_LICENSE = Artistic or GPL-1.0+
PERL_UUID_TINY_LICENSE_FILES = README

$(eval $(perl-package))
