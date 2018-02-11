################################################################################
#
# perl-data-dumper-concise
#
################################################################################

PERL_DATA_DUMPER_CONCISE_VERSION = 2.023
PERL_DATA_DUMPER_CONCISE_SOURCE = Data-Dumper-Concise-$(PERL_DATA_DUMPER_CONCISE_VERSION).tar.gz
PERL_DATA_DUMPER_CONCISE_SITE = $(BR2_CPAN_MIRROR)/authors/id/E/ET/ETHER
PERL_DATA_DUMPER_CONCISE_LICENSE = Artistic or GPL-1.0+
PERL_DATA_DUMPER_CONCISE_LICENSE_FILES = README

$(eval $(perl-package))
