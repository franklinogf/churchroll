import { InputField } from '@/components/forms/inputs/InputField';
import { ResponsiveModal, ResponsiveModalFooterSubmit } from '@/components/responsive-modal';
import { useTranslations } from '@/hooks/use-translations';
import type { ExpenseType } from '@/types/models/expense-type';
import { useForm } from '@inertiajs/react';
import { CurrencyField } from './inputs/CurrencyField';

export function ExpenseTypeForm({ expenseType, open, setOpen }: { expenseType?: ExpenseType; open: boolean; setOpen: (open: boolean) => void }) {
  const { t } = useTranslations();
  const { data, setData, post, put, errors, processing, reset } = useForm({
    name: expenseType?.name ?? '',
    default_amount: expenseType?.defaultAmount?.toString() ?? '',
  });

  function handleSubmit(e: React.FormEvent) {
    e.preventDefault();
    if (expenseType) {
      put(route('codes.expenseTypes.update', expenseType.id), {
        onSuccess: () => {
          setOpen(false);
        },
      });
    } else {
      post(route('codes.expenseTypes.store'), {
        preserveState: false,
        onSuccess: () => {
          setOpen(false);
          reset();
        },
      });
    }
  }
  const MODEL = t('Expense type');
  return (
    <ResponsiveModal
      open={open}
      setOpen={setOpen}
      title={expenseType ? t('Edit :model', { model: MODEL }) : t('Add :model', { model: MODEL })}
      description={expenseType ? t('Edit the details of this :model', { model: MODEL }) : t('Create a new :model', { model: MODEL })}
    >
      <form className="space-y-4" onSubmit={handleSubmit}>
        <InputField required label={t('Name')} value={data.name} onChange={(value) => setData('name', value)} error={errors.name} />
        <CurrencyField
          label={t('Default amount')}
          value={data.default_amount}
          onChange={(value) => setData('default_amount', value)}
          error={errors.default_amount}
        />

        <ResponsiveModalFooterSubmit isSubmitting={processing} label={t('Save')} />
      </form>
    </ResponsiveModal>
  );
}
