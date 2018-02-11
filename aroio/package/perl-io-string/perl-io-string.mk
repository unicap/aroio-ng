################################################################################
#
# perl-io-string
#
################################################################################

PERL_IO_STRING_VERSION = 1.08
PERL_IO_STRING_SOURCE = IO-String-$(PERL_IO_STRING_VERSION).tar.gz
PERL_IO_STRING_SITE = $(BR2_CPAN_MIRROR)/authors/id/G/GA/GAAS
PERL_IO_STRING_LICENSE_FILES = README

$(eval $(perl-package))
