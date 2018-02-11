################################################################################
#
# perl-class-c3-xs
#
################################################################################

PERL_CLASS_C3_XS_VERSION = 0.14
PERL_CLASS_C3_XS_SOURCE = Class-C3-XS-$(PERL_CLASS_C3_XS_VERSION).tar.gz
PERL_CLASS_C3_XS_SITE = $(BR2_CPAN_MIRROR)/authors/id/E/ET/ETHER
PERL_CLASS_C3_XS_LICENSE = Artistic or GPL-1.0+
PERL_CLASS_C3_XS_LICENSE_FILES = README

$(eval $(perl-package))
