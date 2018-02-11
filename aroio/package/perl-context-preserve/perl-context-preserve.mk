################################################################################
#
# perl-context-preserve
#
################################################################################

PERL_CONTEXT_PRESERVE_VERSION = 0.03
PERL_CONTEXT_PRESERVE_SOURCE = Context-Preserve-$(PERL_CONTEXT_PRESERVE_VERSION).tar.gz
PERL_CONTEXT_PRESERVE_SITE = $(BR2_CPAN_MIRROR)/authors/id/E/ET/ETHER
PERL_CONTEXT_PRESERVE_LICENSE = Artistic or GPL-1.0+
PERL_CONTEXT_PRESERVE_LICENSE_FILES = README

$(eval $(perl-package))
