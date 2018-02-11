################################################################################
#
# perl-class-isa
#
################################################################################

PERL_CLASS_ISA_VERSION = 0.36
PERL_CLASS_ISA_SOURCE = Class-ISA-$(PERL_CLASS_ISA_VERSION).tar.gz
PERL_CLASS_ISA_SITE = $(BR2_CPAN_MIRROR)/authors/id/S/SM/SMUELLER
PERL_CLASS_ISA_LICENSE_FILES = README

$(eval $(perl-package))
