################################################################################
#
# perl-class-virtual
#
################################################################################

PERL_CLASS_VIRTUAL_VERSION = 0.08
PERL_CLASS_VIRTUAL_SOURCE = Class-Virtual-$(PERL_CLASS_VIRTUAL_VERSION).tar.gz
PERL_CLASS_VIRTUAL_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/MS/MSCHWERN
PERL_CLASS_VIRTUAL_DEPENDENCIES = perl-carp-assert perl-class-data-inheritable perl-class-isa
PERL_CLASS_VIRTUAL_LICENSE = Artistic or GPL-1.0+

$(eval $(perl-package))
