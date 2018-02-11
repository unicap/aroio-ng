################################################################################
#
# perl-data-uriencode
#
################################################################################

PERL_DATA_URIENCODE_VERSION = 0.11
PERL_DATA_URIENCODE_SOURCE = Data-URIEncode-$(PERL_DATA_URIENCODE_VERSION).tar.gz
PERL_DATA_URIENCODE_SITE = $(BR2_CPAN_MIRROR)/authors/id/R/RH/RHANDOM
PERL_DATA_URIENCODE_LICENSE_FILES = README

$(eval $(perl-package))
